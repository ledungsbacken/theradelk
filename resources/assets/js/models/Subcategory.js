import Model from './Model.js';
import Category from './Category.js';

export default class Subcategory extends Model {

    constructor(args = {}) {
        super({
            'id'          : args.id,
            'slug'        : args.slug,
            'name'        : args.name,
            'category_id' : args.category_id,
        });

        this.category = new Category(args.category);

        this.http.defaults.baseURL += 'subcategory/';
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new Subcategory(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new Subcategory(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new Subcategory(response.data));
    }

    /**
    * @return $promise
    */
    destroy() {
        return this.http
        .delete(this.data.id.toString())
        .then(response => new Subcategory(response.data));
    }

    /**
    * @return $promise
    */
    restoreDestroyed() {
        return this.http
        .put(this.data.id + '/restore')
        .then(response => new Subcategory(response.data));
    }

    /**
    * @return $promise
    */
    hardDelete() {
        return this.http
        .delete(this.data.id + '/hard')
        .then(response => new Subcategory(response.data));
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('subcategory')
            .get(null, {params : args})
            .then((response) => {
                response.data = Subcategory.collect(response.data);
                return response.data;
            });
    }

    /**
     * @return $promise
    */
    static indexByCategory(args = {}) {
        return super._createAxios('category')
            .get(args.category_id + '/subcategory')
            .then((response) => {
                response.data = Subcategory.collect(response.data);
                return response.data;
            });
    }



}
