const fs = require('fs');

const pathToFa = {
    'M15 19l-7-7 7-7': 'fa-solid fa-chevron-left',
    'M19.5 8.25l-7.5 7.5-7.5-7.5': 'fa-solid fa-chevron-down',
    'M21 21l-5.197-5.197m0 0A7.5': 'fa-solid fa-magnifying-glass',
    'M4.5 12.75l6 6 9-13.5': 'fa-solid fa-check',
    'M12 4.5v15m7.5-7.5h-15': 'fa-solid fa-plus',
    'M6 18L18 6M6 6l12 12': 'fa-solid fa-xmark',
    'M12 9v3.75m-9.303': 'fa-solid fa-triangle-exclamation',
    'M9 12.75L11.25 15 15 9.75': 'fa-solid fa-circle-check', // or M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z
    'm22 7-8.991 5.727': 'fa-regular fa-envelope',
    'M17.472 14.382c': 'fa-brands fa-whatsapp',
    'M9.09 9a3 3 0 015.83': 'fa-solid fa-circle-question',
    'M13 16h-1v-4h-1m1-4h.01': 'fa-solid fa-circle-info',
    'M10.29 3.86L1.82 18': 'fa-solid fa-triangle-exclamation',
    'M12 5v14M5 12h14': 'fa-solid fa-plus',
    'M12 9v2m0 4h.01': 'fa-solid fa-circle-exclamation',
    'M9 5H7a2 2 0 00-2 2v12': 'fa-regular fa-clipboard',
    'M20 7l-8-4-8 4m16': 'fa-solid fa-layer-group',
    'M12 2L2 7l10 5 10-5': 'fa-solid fa-layer-group',
    'M5 13l4 4L19 7': 'fa-solid fa-check',
    'M10 19l-7-7m0 0l7-7m-7 7h18': 'fa-solid fa-arrow-left',
    // fallback or others?
};

function replaceIconsForFile(filePath) {
    let content = fs.readFileSync(filePath, 'utf8');
    
    // safe non-greedy regex
    let newContent = content.replace(/<svg[\s\S]*?<\/svg>/g, (match) => {
        // extract class
        let clsMatch = match.match(/class="([^"]+)"/);
        let cls = clsMatch ? clsMatch[1] : '';
        
        // Ensure standard flex centering if not already present
        if (!cls.includes('flex')) {
             cls += ' flex items-center justify-center';
        }

        // extract alpine x-show
        let xShowMatch = match.match(/x-show=\"([^\"]+)\"/);
        let xShow = xShowMatch ? ` x-show="${xShowMatch[1]}"` : '';
        
        // Find matching fa class
        let targetFa = 'fa-solid fa-star'; // debug default
        for (let key in pathToFa) {
            if (match.includes(key)) {
                targetFa = pathToFa[key];
                break;
            }
        }
        
        // handle specific case for the error label since we don't need flex on it usually
        if (targetFa === 'fa-solid fa-triangle-exclamation' && cls.includes('text-red-500 shrink-0')) {
             return `<i class="${targetFa} ${cls}"${xShow}></i>`;  
        }

        return `<i class="${targetFa} ${cls}"${xShow}></i>`;
    });

    fs.writeFileSync(filePath, newContent, 'utf8');
    console.log(`Replaced SVGs in ${filePath}`);
}

['resources/views/web-apps/create.blade.php', 'resources/views/web-apps/edit.blade.php'].forEach(f => {
    try {
        replaceIconsForFile(f);
    } catch (e) {
        console.error('Error on', f, e);
    }
});
