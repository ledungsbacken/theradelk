import Model from './Model.js';

export default class Subscriber extends Model {

    constructor(args = {}) {
        super({
            'id'    : args.id,
            'email' : args.email,
        });

        this.http.defaults.baseURL += 'subscriber/';
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new Subscriber(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new Subscriber(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new Subscriber(response.data));
    }

    /**
    * @return $promise
    */
    destroy() {
        return this.http
        .delete(this.data.id.toString())
        .then(response => new Subscriber(response.data));
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('subscriber')
            .get(null, {params : args})
            .then((response) => {
                response.data = Subscriber.collect(response.data);
                return response;
            });
    }

}
