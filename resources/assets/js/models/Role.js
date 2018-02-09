import Model from './Model.js';

export default class Role extends Model {

    constructor(args = {}) {
        super({
            'id'          : args.id,
            'name'        : args.name,
            'label'       : args.label,
            'description' : args.description,
    });

        this.http.defaults.baseURL += 'role/';
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new Role(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new Role(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new Role(response.data));
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('role')
            .get(null, {params : args})
            .then((response) => {
                response.data = Role.collect(response.data);
                return response.data;
            });
    }


}
