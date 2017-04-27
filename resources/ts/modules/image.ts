export default class Image {
    private static response: any = []

    public static upload(files: any, service: string): void {
        let fd: FormData = new FormData();
        fd.append('service', service);

        for (let k of files) {
            fd.append('image[' + k.name + ']', k);
        }

        fetch('/api/v1/image/save', {
            method: 'post',
            body: fd
        }).then(res => {
            Image.response = res.json();
        });
    }

    public static getResponse(): any[] {
        return Image.response
    }
}