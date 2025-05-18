const APP_URL = import.meta.env.VITE_APP_URL;
const STORAGE_PATH = `${APP_URL}/storage/`;

const calculateRatings = (ratings) => {
    const total = ratings.reduce((sum, rating) => sum + rating, 0);
    const average = total / ratings.length;
    return average;
}

export { APP_URL, STORAGE_PATH, calculateRatings };