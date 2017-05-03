import axios from 'axios'
import config from '../../config'
import Token from './token'
let Promise = require('bluebird')

export default like(post_id, user_id, service) {
	return new Promise(
		function(resolve, reject) {
			let token = new Token

			if ( !this.user ) {
				alertify.notify('You must be logged', 'error', 3)
				return false
			}

			if ( !token.check() ) {
				alertify.notify('You must be logged', 'error', 3);
				return false
			}

			if ( !this.post ) {
				return false
			}

			axios.post(config.url + 'like/set', {
				user_id: this.user,
				post_id: this.post,
				service: this.service,
				access_token: token.get()
			}).then(res => {
				return resolve(true)
			}).catch(error => {
			            if (423 == error.response.status) {
			                for (let k in error.response.data.error_data) {
			                    alertify.notify(error.response.data.error_data[k], 'error', 2);
			                }
			            } else {
			                alertify.notify(error.response.data.error_data, 'error', 3);
			            }
			})
		}
	}
}