import Model from './Model.js';

export default class User extends Model {

    constructor(args = {}) {
        super({
            'id'         : args.id,
            'name'       : args.name,
            'created_at' : args.created_at,
            'updated_at' : args.updated_at,
    });

        this.http.defaults.baseURL += 'user/';
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new User(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new User(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new User(response.data));
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('user')
            .get(null, {params : args})
            .then((response) => {
                response.data.data = User.collect(response.data.data);
                return response.data;
            });
    }

    /**
     * @return $promise
    */
    static isLoggedIn(args = {}) {
        return super._createAxios('user')
            .get('/status')
            .then((response) => {
                return response.data;
            });
    }




}
