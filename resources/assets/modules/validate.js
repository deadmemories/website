const rules = {
    required: 'Поле :attribute является обязательным',
    min: ':attribute не может быть меньше :min',
    max: ':attribute не может быть больше :max',
}

export default class Validate {
    constructor () {
        this.errors = []
    }

    validate (data) {
        for (let k in data) {
            let value = data[k][0]
            let rules = data[k][1]

            if (rules.includes('|')) {
                let arrayRules = rules.split('|')

                for (let d of arrayRules) {
                    d.includes(':')
                        ? this.callMethodWithManyParams(d, k, value)
                        : this.callMethodWithLowParams(d, k, value)
                }
            } else {
                rules.includes(':')
                    ? this.callMethodWithManyParams(rules, k, value)
                    : this.callMethodWithLowParams(rules, k, value)
            }
        }
    }

    getErrors () {
        return this.errors
    }

    isError () {
        return this.errors.length ? true : false
    }

    callMethodWithManyParams (rules, field, value) {
        let methodParams = rules.split(':')
        this[methodParams[0]](field, value, methodParams[1])
    }

    callMethodWithLowParams (rules, field, value) {
        this[rules](field, value)
    }

    required (field, value) {
        if (0 == value.length) {
            this.addError(rules['required'], field)
        }
    }

    min (field, value, min) {
        if (min > value.length) {
            this.addError(rules['min'], field, min)
        }
    }

    max (field, value, max) {
        if (max < value.length) {
            this.addError(rules['max'], field, max)
        }
    }

    addError (message, field, param = null) {
        let error = message.replace(/:attribute/gmi, field).
            replace(/:min|:max/gmi, param)

            this.errors.push(error)
    }
}