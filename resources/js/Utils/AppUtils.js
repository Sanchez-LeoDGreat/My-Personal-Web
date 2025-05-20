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

export { APP_URL, STORAGE_PATH, calculateRatings, generateAvatar };