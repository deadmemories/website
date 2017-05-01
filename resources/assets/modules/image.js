import axios from 'axios'

const URL = '/api/v1/image/'

export default class Image {
    constructor () {
        this.response = []
    }

    upload (files, service) {
        let fd = new FormData()
        fd.append('service', service)

        for (let k of files) {
            fd.append('image[' + k.name + ']', k)
        }

        axios.post(URL + 'save', fd).
            then(res => {
                this.response = res.data.response
            }).
            catch(err => console.log(err))
    }

    getResponse () {
        return this.response
    }
}