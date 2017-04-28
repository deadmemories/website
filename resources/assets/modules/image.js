export default class Image {
    constructor () {
        this.response = []
    }

    public upload (files, service) {
        let fd = new FormData()
        fd.append('service', service)

        for (let k of files) {
            fd.append('image[' + k.name + ']', k)
        }

        fetch('/api/v1/image/save', {
            method: 'post',
            body: fd,
        }).then(res => {
            this.response = res.json()
        })
    }

    public getResponse () {
        return this.response
    }
}