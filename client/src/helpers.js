import axios from 'axios'

export const apiBase = new axios.create({
    baseURL: process.env.VUE_APP_API,
})
