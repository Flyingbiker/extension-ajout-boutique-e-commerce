(function($){

    $(document).ready(() => {

        const sBackgroundColor = $('#background-color_category_description');
        const sUrlImage = $('#url_image_description');
        const bBool = $('#bool_category_description');
        const sStartDate = $('#date_open_category_description');
        const sEndDate = $('#date_close_category_description');
        const sTextDate = $('#text_date_category_description');
        const sNamePage = $('#name_page_shop');
        const sSlugCategory = $('#url_slug_category_description');
        const sUrl = sSlugCategory.val();
        const sShippingType = $('#shipping_type_category_description');
        const serializeButton = $('#serialize_button');

        const sSlug = $('#slug');
        const sDescription = $('#description');

        let sUrlAndSlug = '';
                
        serializeButton.click(function(e){
            e.preventDefault();
            let aArrayToSerialize = [];

            let dateDebut = new Date(sStartDate.val()) ;
            let dateFin = new Date(sEndDate.val());
            let sStringToDisplay = 
                'Du ' +  displayDate(dateDebut)
                + ' au ' + displayDate(dateFin) + ' ' + dateFin.getFullYear();

            sUrlAndSlug = sUrl + '/'+ sNamePage.val() +'/?slug=' + sSlug.val();

            aArrayToSerialize.push({"background-color":sBackgroundColor.val()});
            aArrayToSerialize.push({"image-category":sUrlImage.val()});
            aArrayToSerialize.push({"is-open":bBool.val()});
            aArrayToSerialize.push({"start-date":sStartDate.val()});
            aArrayToSerialize.push({"end-date":sEndDate.val()});
            aArrayToSerialize.push({"periode":sStringToDisplay});
            aArrayToSerialize.push({"url-cat":sUrlAndSlug});
            aArrayToSerialize.push({"shipping-type":sShippingType.val()});

        //serialisation du tableau
            let iLen = aArrayToSerialize.length;
            let string = 'a:' + iLen + ':{';
            for (let i=0 ; i<iLen ; i++){
                string = string + serialize(aArrayToSerialize[i]);
            }
            string = string + '}' ;

            console.log(string);

        //afficher les données dans les inputs
            sSlugCategory.val(sUrlAndSlug);
            sTextDate.val(sStringToDisplay);
            sDescription.val(string);

        });

    });

    /**
     * Convert index of month in full text
     * @param int p_iMonth 
     * @returns string
     */
    function displayDate(p_oDate){
        const aMonths= ['janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 
            'juillet','aout', 'septembre','octobre','novembre','decembre'];
        let day = p_oDate.getDate();
        let month = aMonths[p_oDate.getMonth()];
        return day + ' ' + month;

        // if ( realMonthNumber.toString().length <2){
        //     return '0' + (realMonthNumber.toString());
        // }
        // return realMonthNumber.toString();
    }

    /**
     * Function to make serialization as PHP.serialize()
     * @param {*} txt 
     * @returns string
     */
    function serialize(txt) {
        switch(typeof(txt)){
        case 'string':
            return 's:'+txt.length+':"'+txt+'";';
        case 'number':
            if(txt>=0 && String(txt).indexOf('.') == -1 && txt < 65536) return 'i:'+txt+';';
            return 'd:'+txt+';';
        case 'boolean':
            return 'b:'+( (txt)?'1':'0' )+';';
        case 'object':
            var i=0,k,ret='';
            for(k in txt){
                if(!isNaN(k)) k = Number(k);
                ret += serialize(k)+serialize(txt[k]);
                i++;
            }
            return ret;
            // return 'a:'+i+':{'+ret+'}';

        default:
            return 'N;';
            alert('var undefined: '+typeof(txt));
        }
    }

})(jQuery);
