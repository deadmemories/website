let names = {
    'required': 'The :attribute is required',
}

let validate = {
    data: {
        errorStatus: false,
        errors: [],
    },
    methods: {
        validate(data) {
            for (let k in data) {
                let value = data[k][0]
                let rules = data[k][1]

                if (rules.includes('|')) {
                    let arrayRules = rules.split('|')

                    for (let d of arrayRules) {
                        if (d.includes(':')) {
                            let methodParams = d.split(':')
                            this[methodParams[0]](k, value, methodParams[1])
                        } else {
                            this[d](k, value)
                        }
                    }
                }
            }
        },
        required(input, value) {
            if (0 == value.length) {
                let data = value.replace(/:attribute/gmi, input).
                    replace(/:min|:max/gmi, min)

                this.errors.push(data)
            }
        },
        min(input, value, min) {
            console.log(min)
        },
    },
}

export default validate