const startsWithVowel = (string) => {
    if (typeof string !== "string" || string.length === 0) return false;
    const vowels = "aeiouAEIOU";
    return vowels.includes(string[0]);
};

const ucwords = (string) => {
    return string.replace(/\b\w/g, function(char) {
        return char.toUpperCase();
    });
}

const ucfirst = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

export { startsWithVowel, ucwords, ucfirst }