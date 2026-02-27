const fs = require('fs');
const path = require('path');

function getFiles(dir, filesList = []) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            getFiles(fullPath, filesList);
        } else if (fullPath.endsWith('.blade.php')) {
            filesList.push(fullPath);
        }
    }
    return filesList;
}

const allFiles = getFiles('resources/views');
const paths = new Set();
let totalSvgs = 0;

for (const file of allFiles) {
    const c = fs.readFileSync(file, 'utf8');
    const matches = c.match(/<svg[\s\S]*?<\/svg>/g);
    if (matches) {
        totalSvgs += matches.length;
        for (const m of matches) {
            let p2 = m.match(/<path[^>]*d="([^"]+)"/g);
            if (p2) {
                p2.forEach(x => {
                    let dMatch = x.match(/d="([^"]+)"/);
                    if (dMatch) paths.add(dMatch[1]);
                });
            }
        }
    }
}

// Convert Set to array and print top 100 paths
const pathsArr = Array.from(paths);
console.log(`Found ${totalSvgs} SVGs with ${pathsArr.length} unique paths.`);
fs.writeFileSync('all_svg_paths.txt', pathsArr.join('\n'));
