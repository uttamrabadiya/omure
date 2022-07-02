import * as types from './mutation-types'

export default {
	[types.SET_INITIAL_DATA](state, data) {
		state.store_owner = data.store_owner;
	},

	[types.GET_INITIAL_DATA](state, data) {
		state.isDataLoaded = data
	},
	[types.STATES](state, states) {
		state.states = states
	},
	[types.REVENUE_DATA](state, revenue) {
		state.revenue = revenue
	},
	[types.SUBSCRIPTION_DATA](state, subscriptions) {
		state.subscriptions = subscriptions
	},
	[types.SET_UPCOMING_FEATURES](state, upcoming_features) {
		state.upcoming_features = upcoming_features
	}
}
