const rules = {
    required: 'Поле :attribute является обязательным',
    min: 'Значение :attribute не может быть меньше :min',
    max: 'Значение :attribute не может быть больше :max'
}

export default class Validate {
    private errors: any[] = []

    public validate(data: any): void {
        for (let k of data) {
            let value: any = data[k][0]
            let rules: any = data[k][1]

            if (rules.includes('|')) {
                let arrayRules: string = rules.split('|')

                for (let d of arrayRules) {
                    d.includes(':')
                        ? this.callMethodWithManyParams(d, k, value)
                        : this.callMethodWithLowParams(d, k, value);
                }
            } else {
                rules.includes(':')
                    ? this.callMethodWithManyParams(rules, k, value)
                    : this.callMethodWithLowParams(rules, k, value);
            }
        }
    }

    public getErrors() {
        return this.errors;
    }

    private callMethodWithManyParams(rules: string, field: string, value: any): void {
        let methodParams: string[] = rules.split(':')
        this[methodParams[0]](field, value, methodParams[1])
    }

    private callMethodWithLowParams(rules: string, field: string, value: any): void {
        this[rules](field, value)
    }

    private required(field: string, value: any): void {
        if (0 == value.length) {
            this.addError(rules['required'], field)
        }
    }

    private min(field: string, value: any, min: any): void {
        if (min > value.length) {
            this.addError(rules['min'], field, min)
        }
    }

    private max(field: string, value: any, max: any): void {
        if (max < value.length) {
            this.addError(rules['max'], field, max)
        }
    }

    private addError(message: string, field: string, param: any = null): void {
        let error = message.replace(/:attribute/gmi, field)
            .replace(/:min|:max/gmi, param)

        this.errors.push(error)
    }
}