import { AXIOS } from '../http-common';

export default {
    weather: async function () {
        return await AXIOS.get(`weather`);
    }
}