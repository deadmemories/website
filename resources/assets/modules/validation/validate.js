import rule from './rules.js';

let validate = {
    data: {
        errorStatus: false,
        errors: [],
        rule: rule,
        lang: 'ru'
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
        required(field, value) {
            if (0 == value.length) {
                this.addError(this.rule.lang['required'], field)
            }
        },
        min(field, value, min) {
            if ( min > value.length ) {
                this.addError(this.rule.lang['min'], field, min);
            }
        },
        max(field, value, max) {
            if ( max < value.length ) {
                this.addError(this.rule.lang['max'], field, max);
            }
        },
        addError(message, field, param = null) {
            let error = message.replace(/:attribute/gmi, field).
                replace(/:min|:max/gmi, param)

            this.errors.push(error)
        },
    },
}

export default validate