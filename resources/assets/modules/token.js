export default class Token {
	constructor() {
		this.storage = localStorage;
	}
	get() {
		this.storage.getItem('userToken')
	}

	set(token) {
		this.storage.setItem('userToken', token)
	}

	delete() {
		this.storage.removeItem('userToken')
	}

	check() {
		return this.get() ? true : false
	}
}