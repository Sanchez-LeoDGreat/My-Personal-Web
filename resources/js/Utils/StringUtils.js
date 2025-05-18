const ucwords = (string) => {
    return string.replace(/\b\w/g, function(char) {
        return char.toUpperCase();
    });
}

const ucfirst = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

const getFileType = (filename) => {
    const imageExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.bmp', '.webp', '.svg'];
    const videoExtensions = ['.mp4', '.mov', '.avi', '.mkv', '.webm', '.flv', '.wmv'];

    const ext = filename.toLowerCase().split('.').pop();

    if (imageExtensions.includes(`.${ext}`)) return 'image';
    if (videoExtensions.includes(`.${ext}`)) return 'video';
    return 'unknown';
}

const formattedDate = (dateString) => {
    const date = new Date(dateString);

    const shortMonth = date.toLocaleDateString('en-US', { month: 'short' });

    const day = date.getDate();
    const year = date.getFullYear();

    const formatted = `${shortMonth} ${day}, ${year}`;

    return formatted;
}

const formatToCompactNumber = (number) => {
    if (number < 1000) return number.toString();

    const units = ["K", "M", "B", "T"];
    let unitIndex = -1;

    while (number >= 1000 && unitIndex < units.length - 1) {
        number /= 1000;
        unitIndex++;
    }

    const floored = Math.floor(number * 10) / 10;

    return `${floored}${units[unitIndex]}+`;
};

export { ucwords, ucfirst, getFileType, formattedDate, formatToCompactNumber };