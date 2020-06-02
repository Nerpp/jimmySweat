/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import '../css/global.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

const $ = require('jquery');
jQuery.noConflict();
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

/*$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});*/

let $collectionHolder;

// setup an "add a tag" link
let $addTagButton = $('<button type="button" class="add_pic">Add a tag</button>');
let $newLinkLi = $('<li></li>').append($addTagButton);

$(document).ready(function() {

    // Get the ul that holds the collection of tags
    $collectionHolder = $('ul.pic');

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addPicForm($collectionHolder, $newLinkLi);
    });

});

function addPicForm($collectionHolder, $newLinkLi) {

    // Get the data-prototype explained earlier
    let prototype = $collectionHolder.data('prototype');

    console.log(prototype);

    // get the new index
    let index = $collectionHolder.data('index');

    let newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    console.log(newForm);
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    let $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}
$(function () {
    $(document).delegate('.custom-file-input', 'change', function () {
        let inputFile = $(event.currentTarget);
        let labelToShow = $(inputFile[0].activeElement.labels[1]);
        $(inputFile)
            .find(labelToShow)
            .html(inputFile[0].activeElement.files[0].name);
    });
});

