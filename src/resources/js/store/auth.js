export default {
    namespaced: true,

    state: () => ({
        user: null,
        isGuest: false,
    }),

    mutations: {
        setUser(state, user) {
            state.user = user;
        },

        setIsGuest(state, isGuest) {
            state.isGuest = isGuest;
        }
    },

    actions: {
        async checkUser({commit, getters, dispatch}) {
            let user = getters.getUser;

            if (!user) {

                try {
                    const response = await axios.get('/api/user');
                    dispatch('login', response.data);
                } catch (error) {
                    dispatch('logout');
                }
            }
        },

        logout({commit}) {
            commit('setIsGuest', true);
            commit('setUser', null);
        },

        login({commit}, user) {
            commit('setUser', user);
            commit('setIsGuest', false);
        }
    },

    getters: {
        getUser(state) {
            return state.user;
        },

        getIsGuest(state) {
            return  state.isGuest;
        }
    }
};
