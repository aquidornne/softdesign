import { AXIOS } from '../http-common';

const base = '/livros';

export default {
    index: async function (data) {
        return await AXIOS.post(`${base}/index`, data);
    },
    show: async function (id) {
        return await AXIOS.get(`${base}/${id}`);
    },
    store: async function (data) {
        return await AXIOS.post(`${base}`, data);
    },
    update: async function (id, data) {
        return await AXIOS.put(`${base}/${id}`, data);
    },
    destroy: async function (id) {
        return await AXIOS.delete(`${base}/${id}`);
    },
}
