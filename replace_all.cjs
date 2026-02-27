const fs = require('fs');
const path = require('path');

const pathToFa = {
    'M15 19l-7-7 7-7': 'fa-solid fa-chevron-left',
    'M19.5 8.25l-7.5 7.5-7.5-7.5': 'fa-solid fa-chevron-down',
    'M21 21l-5.197-5.197m0 0A7.5': 'fa-solid fa-magnifying-glass',
    'M4.5 12.75l6 6 9-13.5': 'fa-solid fa-check',
    'M12 4.5v15m7.5-7.5h-15': 'fa-solid fa-plus',
    'M6 18L18 6M6 6l12 12': 'fa-solid fa-xmark',
    'M12 9v3.75m-9.303': 'fa-solid fa-triangle-exclamation',
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
    'M21 21l-6-6m2-5a7 7 0 11-14 0': 'fa-solid fa-magnifying-glass',
    'M15.75 19.5L8.25 12l7.5-7.5': 'fa-solid fa-chevron-left',
    'M8.25 4.5l7.5 7.5-7.5 7.5': 'fa-solid fa-chevron-right',
    'M8 7V3m8 4V3m-9 8h10M5 21h14a2': 'fa-regular fa-calendar',
    'M19 11H5m14 0a2 2 0 012 2v6a2 2': 'fa-solid fa-server',
    'M10 18a8 8 0 100-16 8 8 0 000 16': 'fa-solid fa-eye',
    'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5': 'fa-regular fa-file-alt',
    'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2': 'fa-solid fa-building',
    'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118': 'fa-solid fa-circle-check',
    'M4 4v5h.582m15.356 2A8.001 8.001 0': 'fa-solid fa-rotate',
    'M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z': 'fa-solid fa-chart-pie',
    'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17': 'fa-solid fa-desktop',
    'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z': 'fa-solid fa-users',
    'M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2': 'fa-solid fa-folder-open',
    'M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5': 'fa-solid fa-code',
    'M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25': 'fa-solid fa-globe',
    'M9 5l7 7-7 7': 'fa-solid fa-chevron-right',
    'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25': 'fa-solid fa-fire',
    'M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5': 'fa-solid fa-cube',
    'M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125': 'fa-solid fa-boxes-stacked',
    'M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5': 'fa-solid fa-trash',
    'M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5': 'fa-solid fa-chart-line',
    'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375': 'fa-solid fa-building',
    'M15 10.5a3 3 0 11-6 0 3 3 0 016 0z': 'fa-solid fa-bullseye',
    'M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5': 'fa-solid fa-map-location-dot',
    'M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25': 'fa-solid fa-building-lock',
    'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496': 'fa-solid fa-network-wired',
    'M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227': 'fa-solid fa-location-arrow',
    'M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9': 'fa-solid fa-cube',
    'M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z': 'fa-solid fa-chart-pie',
    'M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z': 'fa-solid fa-chart-pie',
    'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871': 'fa-solid fa-print',
    'M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941': 'fa-solid fa-bolt',
    'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016': 'fa-solid fa-table-cells-large',
    'm21 21-4.35-4.35M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16z': 'fa-solid fa-magnifying-glass',
    'M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9': 'fa-solid fa-sort',
    'M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3': 'fa-solid fa-arrow-right',
    'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0': 'fa-solid fa-box-open',
    'M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10': 'fa-solid fa-pen-to-square',
    'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z': 'fa-regular fa-image',
    'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z': 'fa-regular fa-envelope',
    'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z': 'fa-solid fa-lock',
    'M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z': 'fa-solid fa-file-arrow-down',
    'M11 17l-5-5m0 0l5-5m-5 5h12': 'fa-solid fa-arrow-right-to-bracket',
    'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z': 'fa-solid fa-user-plus',
    'M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z': 'fa-solid fa-house',
    'M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z': 'fa-solid fa-chevron-right',
    'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z': 'fa-solid fa-key',
    'M12 6v6m0 0v6m0-6h6m-6 0H6': 'fa-solid fa-plus',
    'M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14': 'fa-solid fa-arrow-up-right-from-square',
    'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z': 'fa-solid fa-magnifying-glass',
    'm9 12 2 2 4-4': 'fa-solid fa-check',
    'm15 9-6 6': 'fa-solid fa-xmark',
    'm9 9 6 6': 'fa-solid fa-xmark',
    'M4 6h16M4 10h16M4 14h16M4 18h16': 'fa-solid fa-bars',
    'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z': 'fa-solid fa-user',
    'M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z': 'fa-solid fa-eye',
    'M3 6h18': 'fa-solid fa-minus',
    'M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6': 'fa-solid fa-trash-can',
    'M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2': 'fa-solid fa-trash-can',
    'M3 21h18': 'fa-solid fa-minus',
    'M5 21V7l8-4 8 4v14': 'fa-solid fa-building',
    'M9 21v-6h6v6': 'fa-solid fa-door-open',
    'm21 21-4.35-4.35': 'fa-solid fa-magnifying-glass',
    'M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z': 'fa-solid fa-circle-notch fa-spin',
    'M18 6 6 18': 'fa-solid fa-xmark',
    'm6 6 12 12': 'fa-solid fa-xmark',
    'M5 12h14': 'fa-solid fa-minus',
    'M12 5v14': 'fa-solid fa-minus',
    'M12 16v-4': 'fa-solid fa-exclamation',
    'M12 8h.01': 'fa-solid fa-exclamation',
    'm21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z': 'fa-solid fa-triangle-exclamation',
    'M12 9v4': 'fa-solid fa-exclamation',
    'M12 17h.01': 'fa-solid fa-exclamation',
    'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z': 'fa-solid fa-triangle-exclamation',
    'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z': 'fa-solid fa-circle-check',
    'M12 2a10 10 0 1010 10A10.011 10.011 0 0012 2zm0 18a8 8 0 118-8 8.009 8.009 0 01-8 8z': 'fa-regular fa-circle',
    'M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1.177-7.86l-2.765-2.767L7 12.431l3.118 3.121a1 1 0 001.414 0l5.952-5.95-1.062-1.062-5.6 5.6z': 'fa-solid fa-circle-check'
};

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

for (const file of allFiles) {
    let content = fs.readFileSync(file, 'utf8');
    let replaced = false;

    let newContent = content.replace(/<svg[\s\S]*?<\/svg>/g, (match) => {
        // Skip background graphics
        if (match.includes('viewBox="0 0 1000') || match.includes('C ') || match.includes('1200')) {
            return match;
        }

        let clsMatch = match.match(/class="([^"]+)"/);
        let cls = clsMatch ? clsMatch[1] : '';

        if (!cls.includes('flex')) {
            cls += ' flex items-center justify-center';
        }

        let xShowMatch = match.match(/x-show=\"([^\"]+)\"/);
        let xShow = xShowMatch ? ` x-show="${xShowMatch[1]}"` : '';
        let styleMatch = match.match(/style=\"([^\"]+)\"/);
        let style = styleMatch ? ` style="${styleMatch[1]}"` : '';

        // Find matching fa class
        let targetFa = null;
        for (let key in pathToFa) {
            if (match.includes(key)) {
                targetFa = pathToFa[key];
                break;
            }
        }

        if (targetFa) {
            replaced = true;
            return `<i class="${targetFa} ${cls}"${xShow}${style}></i>`;
        }

        // Detailed fallback log
        console.log(`[WARN] No exact match in ${file} for SVG. Falling back based on text color.`);

        if (match.includes('text-red-')) targetFa = 'fa-solid fa-trash';
        else if (match.includes('text-indigo-') || match.includes('text-blue-') || match.includes('text-emerald-')) targetFa = 'fa-solid fa-pen-to-square';
        else if (match.includes('text-amber-') || match.includes('text-orange-')) targetFa = 'fa-solid fa-triangle-exclamation';
        else targetFa = 'fa-solid fa-circle-check';

        replaced = true;
        return `<i class="${targetFa} ${cls}"${xShow}${style}></i>`;
    });

    if (replaced) {
        fs.writeFileSync(file, newContent, 'utf8');
        console.log(`Replaced SVGs in ${file}`);
    }
}
