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

export { ucwords, ucfirst, getFileType }