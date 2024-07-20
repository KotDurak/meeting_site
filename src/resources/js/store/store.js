import {createStore} from "vuex";
import messages from "./messages.js";
import auth from "./auth.js";


export default createStore({
    state() {
        return {
          count: 0
        };
    },
    mutations:{
        addCount(state, count = 1) {
            state.count += count;
        }
    },

    getters: {
        getCount(state) {
            return state.count;
        }
    },

    actions: {
      doIncrement(context, cnt  = 5) {
          context.commit('addCount', cnt);
      }
    },

    modules: {
        messages,
        auth,
    }
});
