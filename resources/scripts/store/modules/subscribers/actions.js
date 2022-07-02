import * as types from './mutation-types'

export const loadSubscriberStatus = ({commit, dispatch, state}, params) => {
	return new Promise((resolve, reject) => {
		axios.get(`/api/v1/subscriber-statues`, {params}).then((response) => {
			commit(types.STATUSES, response.data)
			resolve(response)
		}).catch((err) => {
			reject(err)
		})
	})
}

export const loadSubscribers = ({commit, dispatch, state}, params) => {
    return new Promise((resolve, reject) => {
        axios.get(`/api/v1/subscriber`, params).then((response) => {
            commit(types.SUBSCRIBERS, response.data)
            resolve(response)
        }).catch((err) => {
            reject(err)
        })
    })
}

export const loadSubscriber = ({commit, dispatch, state}, id) => {
    return new Promise((resolve, reject) => {
        axios.get(`/api/v1/subscriber/${id}`).then((response) => {
            commit(types.SUBSCRIBER, response.data)
            resolve(response)
        }).catch((err) => {
            reject(err)
        })
    })
}

export const storeSubscriber = ({commit, dispatch, state}, params) => {
	return new Promise((resolve, reject) => {
        const { id } = params;
        let request = 'post';
        let uri = '/api/v1/subscriber'

        if (id) {
            request = 'put';
            uri = `/api/v1/subscriber/${id}`
        }

		axios[request]( uri, params).then((response) => {
			commit(types.SUBSCRIBER, response.data)
			resolve(response)
		}).catch((err) => {
			reject(err)
		})
	})
}
