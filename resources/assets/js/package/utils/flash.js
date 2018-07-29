const default_flash_message_type = 'success';

/**
 * @author Sebastian Szczepanski
 */
class Flash{

    /**
     * @param message
     * @param parameters
     */
    success(message, parameters = {}){
        return this.handle(message, 'success', parameters);
    }

    /**
     * @param message
     * @param parameters
     */
    error(message, parameters = {}){
        return this.handle(message, 'default', parameters);
    }

    /**
     * @param message
     * @param parameters
     */
    warning(message, parameters = {}){
        return this.handle(message, 'warning', parameters);
    }

    /**
     * @param message
     * @param parameters
     */
    info(message, parameters = {}){
        return this.handle(message, 'info', parameters);
    }

    /**
     * default flash message
     * @param message
     * @param parameters
     */
    base(message, parameters = {}){
        return this.handle(message, 'default', parameters);
    }

    /**
     * Handle Flash Message
     * @param message
     * @param type
     * @param parameters
     */
    handle(message, type = null, parameters = {}){
       if(type === null) {
           type = default_flash_message_type
       }

       parameters = Object.assign({
           important: false,
           timeout: 3000
       }, parameters);

       Event.fire('flash', {
           message, type, parameters
       });
    }
}
window.flash = (message = null, type = null, parameters = {}) => {
    let flash = new Flash();

    if(message === null) {
         return flash;
    }
    
    return flash.handle(message, type, parameters);
};
// flash(message)  - success message
// flash()->success(message)
// flash()
// flash(message, 'success', { title: 'Test title' })