import * as types from './mutation-types'

export default {
	[types.STATUSES](state, data) {
		state.statuses = data.statuses;
	},
	[types.SUBSCRIBER](state, data) {
		state.subscriber = data.subscriber;
	},
	[types.SUBSCRIBERS](state, data) {
		state.subscribers = data.subscribers;
	}
}
