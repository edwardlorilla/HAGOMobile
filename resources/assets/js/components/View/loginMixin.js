/**
 * Created by Edward Lance Lorilla on 1/23/2018.
 */
import {isDisable, changeDisable, toggleAuth} from './../Ajax/getData'
export var signin = {
    data(){
        return {
            isDisable,
            loginUser: {
                email: '',
                password: '',
            },
            isLoading: false,
            errors: []
        }
    },
    mounted(){
        console.log('123qwe')
    },
    methods: {
        isFormValid(){
            var vm = this
            return !!(vm.loginUser.email.length > 0 && vm.loginUser.password.length > 0);

        },
        userLogin(){
            var vm = this

            if (vm.isFormValid()) {
                changeDisable(true)
                vm.errors = []
                firebase.auth().signInWithEmailAndPassword(vm.loginUser.email, vm.loginUser.password).then(function (user) {
                    firebase.auth().signInWithEmailAndPassword(vm.loginUser.email, vm.loginUser.password)
                    changeDisable(false)
                    vm.$router.push('/')
                }).catch(function (error) {
                    changeDisable(false)
                    vm.errors.push(error.message)
                })
            }
            /* var vm = this
             changeDisable(true)
             axios.post('/login', vm.loginUser)
             .then(function (response) {
             console.log(response);
             changeDisable(false)
             toggleAuth()
             })
             .catch(function (error) {
             console.log(error);
             changeDisable(false)
             });*/

        }
    }
}