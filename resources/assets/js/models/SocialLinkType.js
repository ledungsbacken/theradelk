import Model from './Model.js';

export default class SocialLinkType extends Model {

    constructor(args = {}) {
        super({
            'id'          : args.id,
            'name'        : args.name,
            'label'       : args.label,
            'description' : args.description,
    });

        this.http.defaults.baseURL += 'sociallinktype/';
    }

    /**
     * @return $promise
    */
    show() {
        return this.http
            .get(this.data.id.toString())
            .then(response => new SocialLinkType(response.data));
    }

    /**
     * @return $promise
    */
    store() {
        return this.http
            .post(null, this.data)
            .then(response => new SocialLinkType(response.data));
    }

    /**
     * @return $promise
    */
    update() {
        return this.http
            .put(this.data.id.toString(), this.data)
            .then(response => new SocialLinkType(response.data));
    }

    /**
     * @return $promise
    */
    static index(args = {}) {
        return super._createAxios('sociallinktype')
            .get(null, {params : args})
            .then((response) => {
                response.data = SocialLinkType.collect(response.data);
                return response;
            });
    }


}