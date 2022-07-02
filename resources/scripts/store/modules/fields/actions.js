import * as types from './mutation-types'

export const loadFields = ({commit, dispatch, state}, params) => {
	return new Promise((resolve, reject) => {
		axios.get(`/api/v1/fields`, {params}).then((response) => {
			commit(types.FIELDS, response.data)
			resolve(response)
		}).catch((err) => {
			reject(err)
		})
	})
}
