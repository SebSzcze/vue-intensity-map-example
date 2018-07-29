let lari = {
    /**
     * Generate unique id
     * @returns {string}
     */
    uuid()
    {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }

        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
            s4() + '-' + s4() + s4() + s4();
    },

    media(uri){
        return 'storage/' + uri
    }
};
export default lari;