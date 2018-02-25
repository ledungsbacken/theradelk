import Moment from 'moment';

export default class Model {

    constructor(args) {
        this.data = {};
        this._original = {};
        this._setAttributes(args);
        this.http = this._createAxios();
    }

    /**
     * @return axios
    */
    _createAxios() {
        return Model._createAxios();
    }

    /**
     * @return void
    */
    _setAttributes(args = {}) {
        for(let key in args) {
            if(typeof args[key] !== 'function') {
                this.data[key] = args[key];
                this._original[key] = args[key];
            }
        }
        return this;
    }

    /**
     * @return void
    */
    reset() {
        for(let key in this._original) {
            this.data[key] = this._original[key];
        }
        return this;
    }

    /**
     * @return void
    */
    dateToString(date) {
        return Model.dateToString(date);
    }

    /**
     * @return void
    */
    static dateToString(date) {
        date = Moment.utc(date);
        return Moment(date).fromNow();
    }

    /**
     * @return void
    */
    static collect(arr = []) {
        let resource = [];
        for(let key in arr) {
            resource[key] = new this(arr[key]);
        }
        return resource
    }

    /**
     * @return axios
    */
    static _createAxios(url = '') {
        let http = axios.create({
            'baseURL' : 'api/' + url
        });

        this.registerDefaultResponseInterceptor(http);

        return http;
    }

    static registerDefaultResponseInterceptor(http) {
        http.interceptors.response.use(function (response) {
            // Do something with response data
            return response;
        }, function (error) {
            let status = error.response.status;
            switch (true) {
                case /401/.test(status):
                    alert(error);
                    // window.location = '/';
                    break;
                case /406/.test(status):
                    alert(error+'\n'+error.response.data);
                    break;
                case /413/.test(status):
                    alert(error+'\n'+error.response.data);
                    break;
                case /415/.test(status):
                    alert(error+'\n'+error.response.data);
                    break;
                case /422/.test(status):
                    break;
                case /^4..$/.test(status):
                    alert(error);
                    break;
                case /^5..$/.test(status):
                    alert(error);
                    break;
            }
            return Promise.reject(error);
        });
    }


}
