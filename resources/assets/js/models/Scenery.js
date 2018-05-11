import Model from './Model.js';
import Post from './Post.js';
import Category from './Category.js';

export default class Scenery extends Model {

    constructor(args = {}) {
        super({
            'id'             : args.id,
            'category_id'    : args.category_id,
            'first_post_id'  : args.first_post_id,
            'second_post_id' : args.second_post_id,
            'third_post_id'  : args.third_post_id,
        });

        this.category = args.category ? new Category(args.category) : undefined;
        this.firstPost = args.first_post ? new Post(args.first_post) : undefined;
        this.secondPost = args.second_post ? new Post(args.second_post) : undefined;
        this.thirdPost = args.third_post ? new Post(args.third_post) : undefined;

        this.http.defaults.baseURL += 'scenery/';
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('scenery')
            .get(null, {params : args})
            .then((response) => {
                response.data = Scenery.collect(response.data);
                return response.data;
            });
    }

    /**
     * @return $promise
    */
    show(args = {}) {
        return this.http
            .get(this.data.id.toString(), {params : args})
            .then(response => new Scenery(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new Scenery(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new Scenery(response.data));
    }

}