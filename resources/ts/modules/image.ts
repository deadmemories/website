export default class Image {
    private response: any = []

    public upload(files: any, service: string): void {
        let fd: FormData = new FormData();
        fd.append('service', service);

        for (let k of files) {
            fd.append('image[' + k.name + ']', k);
        }

        fetch('/api/v1/image/save', {
            method: 'post',
            body: fd
        }).then(res => {
            this.response = res.json();
        });
    }

    public getResponse(): any[] {
        return this.response
    }
}