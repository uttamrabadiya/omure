import mutations from './mutations'
import * as actions from './actions'
import * as getters from './getters'

const initialState = {
	store_owner: null,
	recurringRevenue: null,
	activeSubscription: null,
	failedPayments: null,
	states: [],
	revenue: [],
	subscriptions: [],
	isDataLoaded: false,
	upcoming_features: [],
}

export default {
	namespaced: true,

	state: initialState,

	getters: getters,

	actions: actions,

	mutations: mutations
}
