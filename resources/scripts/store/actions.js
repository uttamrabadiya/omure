import * as types from './mutation-types'

export default {
	bootstrap({commit, dispatch, state}) {
		return new Promise((resolve, reject) => {
			window.axios.get('/api/shop').then((response) => {
				commit(types.SET_INITIAL_DATA, response.data);
				commit(types.UPDATE_APP_LOADING_STATUS, true)

				resolve(response)
			}).catch((err) => {
				reject(err)
			})
		})
	},
	acceptTerms({commit, dispatch, state}) {
		return new Promise((resolve, reject) => {
			window.axios.post('/api/shop/accept-terms').then((response) => {
				resolve(response)
			}).catch((err) => {
				reject(err)
			})
		})
	}
}
