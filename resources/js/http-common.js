// Arquivo axios.js

import axios from 'axios';
import store from '@/store';

const paramsAxios = {
  baseURL: process.env.baseURL,
  headers: {
    'Content-Type': 'application/json'
  }
};

const api = axios.create(paramsAxios);

const errorHandler = async error => {
  store.dispatch('loader/loading', false);
  const e = {
    responseText: error.request.responseText,
    responseURL: error.request.responseURL,
    status: error.request.status,
    statusText: error.request.statusText,
    requestwithCredentials: error.request.withCredentials
  };

  if (
    error.response &&
    (error.response.status === 401 ||
      error.response.status === 419 ||
      error.response.status === 403)
  ) {
    window.location.href = '/login';
  } else {
    store.dispatch('msgError/showErrorMsg');
  }

  return Promise.reject(e);
};

const successHandler = response => {
  store.dispatch('loader/loading', false);
  return response;
};

api.interceptors.response.use(
  response => successHandler(response),
  error => errorHandler(error)
);

api.interceptors.request.use(
  config => {
    store.dispatch('loader/loading', true);
    return config;
  },
  error => {
    store.dispatch('loader/loading', false);
    return Promise.reject(error);
  }
);

export const AXIOS = api;
