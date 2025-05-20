import { createAvatar } from '@dicebear/core';
import { thumbs } from '@dicebear/collection';

const APP_URL = import.meta.env.VITE_APP_URL;
const STORAGE_PATH = `${APP_URL}/storage/`;

const calculateRatings = (ratings) => {
    const total = ratings.reduce((sum, rating) => sum + rating, 0);
    const average = total / ratings.length;
    return average || 0;
}

const generateAvatar = (seed, collection = thumbs) => {
    const avatar = createAvatar(collection, {
        seed: seed,
    });

    return avatar.toDataUri();
}

const downloadFromBlob = (data, filename) => {
    const blob = new Blob([data]);
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.className = "hidden";
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    a.remove();
    window.URL.revokeObjectURL(url);
}

export { APP_URL, STORAGE_PATH, calculateRatings, generateAvatar, downloadFromBlob };