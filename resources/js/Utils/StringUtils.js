const startsWithVowel = (string) => {
    if (typeof string !== "string" || string.length === 0) return false;
    const vowels = "aeiouAEIOU";
    return vowels.includes(string[0]);
};

export { startsWithVowel }