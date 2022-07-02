import Vuex from 'vuex'

import fields from './modules/fields'
import subscribers from './modules/subscribers'

export default new Vuex.Store({
	strict: true,
	modules: {
		fields,
		subscribers,
	}
})
