/**
 * let config = {};
 *
 * let rules = {
 *     id: {
 *         minLength: 1,
 *         maxLength: 2,
 *         required: true,
 *         pattern: /[a-zA-Z]* /,
 *         dataType: "number",
 *     },
 * };
 */

/**
 *
 * @param form
 * @param rules
 * @param messages (Optional)
 * @param config (Optional)
 */
function addValidator(form, rules, messages = {default: "Input Error"},
                      config
                          = {
                          errorMsg: ".error", showBorderInput: true,
                          showFieldBorder: true,
                          showConfirm: false
                      }) {
    if (!messages) {
        if (typeof messages.default === "undefined") {
            messages.default = "Input Error";
        }
    } else if (typeof messages.default === "undefined") {
        messages.default = "Input Error";
    }
    for (let id in rules) {

        /**
         * Sets the default value for undefined values
         *
         */

        if (typeof rules[id] !== "undefined") {
            if (typeof rules[id].minLength === "undefined") {
                rules[id].minLength = null;
            }
            if (typeof rules[id].maxLength === "undefined") {
                rules[id].maxLength = null;
            }
            if (typeof rules[id].required === "undefined") {
                rules[id].required = null;
            }
            if (typeof rules[id].pattern === "undefined") {
                rules[id].pattern = null;
            }
            if (typeof rules[id].dataType === "undefined") {
                rules[id].dataType = null;
            }
            if (typeof rules[id].list === "undefined") {
                rules[id].list = null;
            }
        } else {
            rules[id] = {
                minLength: null,
                maxLength: null,
                required: false,
                pattern: null,
                dataType: null,
                list: null,
            }
        }

        if (typeof messages[id] !== "undefined") {
            if (typeof messages[id].message === "undefined") {
                messages[id].message = messages.default;
            }
            if (typeof messages[id].length === "undefined") {
                messages[id].length = messages.default;
            }
            if (typeof messages[id].missing === "undefined") {
                messages[id].missing = "Required";
            }
        } else {
            messages[id] = {
                message: messages.default,
                length: messages.default,
                missing: "Required"
            }
        }

        /**
         * Sets event handler for form inputs
         */
        $("#" + id).on("change keydown focus", function () {
            $(this).parent().removeClass("error");
            $(this).siblings(config.errorMsg).text("");
        });
    }
    $(form).submit(function () {
        console.log("Validating...");
        let isValid = true;
        for (let id in rules) {
            /**
             *
             *  Initialize variables for element, error element and gets value of input
             */

            let elem = "#" + id;
            let value = $(elem).val();
            let errorElem = $(elem).siblings(config.errorMsg);

            if (rules[id].dataType === 'number') {
                value = parseInt(value);
            }
            /**
             *
             *  Checks if value is present
             */
            if (rules[id].required
                && ((typeof value == 'object' && value.length === 0)
                    || !value)) {
                $(elem).parent().addClass("error");
                isValid = isValid && false;
                errorElem.text(messages[id].missing);
                continue;
            }

            //Checks if a value contains in given list
            if (rules[id].list) {
                let error = false;
                if (typeof value === "object") {
                    for (let v in value) {
                        if (!rules[id].list.includes(v)) {
                            error = true;
                            break;
                        }
                    }
                } else if (!rules[id].list.includes(value)) {
                    error = true;
                }
                if (error) {
                    $(elem).parent().addClass("error");
                    errorElem.text(messages[id].message);
                    isValid = isValid && false;
                    continue;
                }
            }

            /**
             * Check value matches to given pattern
             */
            if ((rules[id].pattern && !value.match(rules[id].pattern))) {
                $(elem).parent().addClass("error");
                console.log("Pattern Error" + id);
                errorElem.text(messages[id].message);
                isValid = isValid && false;
                continue;
            }

            /**
             *
             *   Checks value is in range or value length is in range
             */
            console.log(rules[id].minLength)
            if ((rules[id].minLength != null && (( typeof value === "number" &&
                    value < rules[id].minLength ) || value.length < rules[id].minLength )) ||
                ( rules[id].maxLength != null && ((typeof value === "number" &&
                    value > rules[id].maxLength) || value.length > rules[id].maxLength ))
            ) {
                $(elem).parent().addClass("error");
                errorElem.text(messages[id].length);
                isValid = isValid && false;
                continue;
            }

            /**
             *
             * Removes error text and class if no error
             */
            $(elem).parent().removeClass("error");
            errorElem.text("");
            isValid = isValid && true;
        }
        // console.log("Form Valid : " + isValid);
        // console.log($("form").serializeArray());
        if(isValid && config.showConfirm){
            if(confirm("Do you want to submit the form")) {
                alert("Success");
                return isValid;
            }
            else return false;
        }
        return isValid;
    })
}