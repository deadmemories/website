import axios from 'axios'
import config from '../config'

export default class Image {
    constructor () {
        this.response = []
    }

    upload (files, service, object) {
        let fd = new FormData()
        fd.append('service', service)

        for (let k of files) {
            fd.append('image[' + k.name + ']', k)
        }

        axios.post(config.url + 'image/save', fd).
            then(res => {
                object.image = res.data.response
            }).
            catch(err => console.log(err))
    }
}