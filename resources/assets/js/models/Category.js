import Model from './Model.js';

export default class Category extends Model {

    constructor(args = {}) {
        super({
            'id'          : args.id,
            'slug'        : args.slug,
            'name'        : args.name,
        });

        this.http.defaults.baseURL += 'category/';
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new Category(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new Category(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new Category(response.data));
    }

    /**
    * @return $promise
    */
    destroy() {
        return this.http
        .delete(this.data.id.toString())
        .then(response => new Category(response.data));
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('category')
            .get(null, {params : args})
            .then((response) => {
                response = Category.collect(response.data);
                return response;
            });
    }



}
