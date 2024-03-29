<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap Dual Listbox</title>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
    <link rel="stylesheet" type="text/css" href="../src/bootstrap-duallistbox.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>
    <script src="../src/jquery.bootstrap-duallistbox.js"></script>
  </head>
  <body class="container">

    <div class="row">

      <div class="hero-unit">
        <h1>Bootstrap Dual Listbox</h1>
        <a id="link-ghp" class="btn btn-primary" href="https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox" target="_blank"><span class="glyphicon glyphicon-link"></span> Github project page</a>
      </div>

      <p>
        Bootstrap Dual Listbox is a responsive dual listbox widget optimized for Twitter Bootstrap. It works on all modern browsers and on touch devices.
      </p>

    </div>

  </div>


  <h2>Example with default values</h2>
  <p>
    The dual listbox is created from a select multiple by calling <code>.bootstrapDualListbox(settings);</code> on a selector. The selector can be any element, not just selects. When the method is called on a selector other than a select, then all select childrens are converted into dual list boxes.
  </p>

  <pre class="prettyprint">
var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();</pre>
  <form id="demoform" action="#" method="post">
    <select multiple="multiple" size="10" name="duallistbox_demo1[]">
      <option value="option1">Option 1</option>
      <option value="option2">Option 2</option>
      <option value="option3" selected="selected">Option 3</option>
      <option value="option4">Option 4</option>
      <option value="option5">Option 5</option>
      <option value="option6" selected="selected">Option 6</option>
      <option value="option7">Option 7</option>
      <option value="option8">Option 8</option>
      <option value="option9">Option 9</option>
      <option value="option0">Option 10</option>
    </select>
    <br>
    <button type="submit" class="btn btn-default btn-block">Submit data</button>
  </form>
  <script>
    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
    $("#demoform").submit(function() {
      alert($('[name="duallistbox_demo1[]"]').val());
      return false;
    });
  </script>

  <h2>Example with custom settings</h2>

  <div class="row">
    <div class="col-md-5">
      <pre class="prettyprint lang-js">
var demo2 = $('.demo2').bootstrapDualListbox({
  nonSelectedListLabel: 'Non-selected',
  selectedListLabel: 'Selected',
  preserveSelectionOnMove: 'moved',
  moveOnSelect: false,
  nonSelectedFilter: 'ion ([7-9]|[1][0-2])'
});</pre>
    </div>
    <div class="col-md-7">
      <select multiple="multiple" size="10" name="duallistbox_demo2" class="demo2">
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3" selected="selected">Option 3</option>
        <option value="option4">Option 4</option>
        <option value="option5">Option 5</option>
        <option value="option6" selected="selected">Option 6</option>
        <option value="option7">Option 7</option>
        <option value="option8">Option 8</option>
        <option value="option9">Option 9</option>
        <option value="option0">Option 10</option>
        <option value="option0">Option 11</option>
        <option value="option0">Option 12</option>
        <option value="option0">Option 13</option>
        <option value="option0">Option 14</option>
        <option value="option0">Option 15</option>
        <option value="option0">Option 16</option>
        <option value="option0">Option 17</option>
        <option value="option0">Option 18</option>
        <option value="option0">Option 19</option>
        <option value="option0">Option 20</option>
      </select>
      <script>
        var demo2 = $('.demo2').bootstrapDualListbox({
          nonSelectedListLabel: 'Non-selected',
          selectedListLabel: 'Selected',
          preserveSelectionOnMove: 'moved',
          moveOnSelect: false,
          nonSelectedFilter: 'ion ([7-9]|[1][0-2])'
        });
      </script>
    </div>
  </div>

  <h2>Dynamically add options to the selects</h2>
  <p>
    The options must be added to/removed from the original select.<br>
    Note that the <code>refresh</code> must be run on it after manipulating the options.
  </p>
  <p>
    If there are some highlighted options in the lists, then calling the <code>refresh</code> method with the optional <code>true</code> parameter results the highlights to be removed. Example usage: <code>demo2.bootstrapDualListbox('refresh', true);</code><br>
    It has meaning only when <code>moveOnSelect</code> setting is <code>false</code>.
  </p>
  <p>
    <button id="demo2-add" type="button" class="btn btn-primary">Add options to demo2</button>
    <button id="demo2-add-clear" type="button" class="btn btn-primary">Add with clearing highlights</button>
  </p>
  <pre class="prettyprint">
$("#demo2-add").click(function() {
  demo2.append('<option value="apples">Apples</option><option value="oranges" selected>Oranges</option>');
  demo2.bootstrapDualListbox('refresh');
});

$("#demo2-add-clear").click(function() {
  demo2.append('<option value="apples">Apples</option><option value="oranges" selected>Oranges</option>');
  demo2.bootstrapDualListbox('refresh', true);
});</pre>
  <script>
    $("#demo2-add").click(function() {
      demo2.append('<option value="apples">Apples</option><option value="oranges" selected>Oranges</option>');
      demo2.bootstrapDualListbox('refresh');
    });
    $("#demo2-add-clear").click(function() {
      demo2.append('<option value="apples">Apples</option><option value="oranges" selected>Oranges</option>');
      demo2.bootstrapDualListbox('refresh', true);
    });
  </script>

  <h2>Settings</h2>

  <p>When calling $("#element").bootstrapDualListbox() you can pass a parameters object with zero or more of the following:</p>

  <table class="table table-striped table-bordered docs">
    <thead>
      <tr>
        <th>Option</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><code>bootstrap2Compatible</code></td>
        <td><code><strong>false</strong></code>: set this to <code>true</code> if you want graphic compatibility with Bootstrap 2.</td>
      </tr>
      <tr>
        <td><code>filterTextClear</code></td>
        <td><code><strong>'show all'</strong></code>: the text for the "Show All" button.</td>
      </tr>
      <tr>
        <td><code>filterPlaceHolder</code></td>
        <td><code><strong>'Filter'</strong></code>: the placeholder for the <code>input</code> element for filtering elements.</td>
      </tr>
      <tr>
        <td><code>moveSelectedLabel</code></td>
        <td><code><strong>'Move selected'</strong></code>: the label for the "Move Selected" button.</td>
      </tr>
      <tr>
        <td><code>moveAllLabel</code></td>
        <td><code><strong>'Move all'</strong></code>: the label for the "Move All" button.</td>
      </tr>
      <tr>
        <td><code>removeSelectedLabel</code></td>
        <td><code><strong>'Remove selected'</strong></code>: the label for the "Remove Selected" button.</td>
      </tr>
      <tr>
        <td><code>removeAllLabel</code></td>
        <td><code><strong>'Remove all'</strong></code>: the label for the "Remove All" button.</td>
      </tr>
      <tr>
        <td><code>moveOnSelect</code></td>
        <td><code><strong>true</strong></code>: determines whether to move <code>options</code> upon selection. This option is forced to <code>true</code> on the Android browser.</td>
      </tr>
      <tr>
        <td><code>preserveSelectionOnMove</code></td>
        <td><code><strong>false</strong></code>: can be <code>'all'</code> (for selecting both moved elements and the already selected ones in the target list) or <code>'moved'</code> (for selecting moved elements only)</td>
      </tr>
      <tr>
        <td><code>selectedListLabel</code></td>
        <td><code><strong>false</strong></code>: can be a string specifying the name of the selected list.</td>
      </tr>
      <tr>
        <td><code>nonSelectedListLabel</code></td>
        <td><code><strong>false</strong></code>: can be a string specifying the name of the non selected list.</td>
      </tr>
      <tr>
        <td><code>helperSelectNamePostfix</code></td>
        <td><code><strong>'_helper'</strong></code>: The added selects will have the same name as the original one, concatenated with this string and 1 (for the non selected list, e.g. element_helper1) or 2 (for the selected list, e.g. element_helper2).</td>
      </tr>
      <tr>
        <td><code>selectorMinimalHeight</code></td>
        <td><code><strong>100</strong></code>: represents the minimal height of the generated dual listbox.</td>
      </tr>
      <tr>
        <td><code>showFilterInputs</code></td>
        <td><code><strong>true</strong></code>: whether to show filter inputs.</td>
      </tr>
      <tr>
        <td><code>nonSelectedFilter</code></td>
        <td><code><strong>''</strong></code>: initializes the dual listbox with a filter for the non selected elements. This is applied only if <code>showFilterInputs</code> is set to <code>true</code>.</td>
      </tr>
      <tr>
        <td><code>selectedFilter</code></td>
        <td><code><strong>''</strong></code>: initializes the dual listbox with a filter for the selected elements. This is applied only if <code>showFilterInputs</code> is set to <code>true</code>.</td>
      </tr>
      <tr>
        <td><code>infoText</code></td>
        <td><code><strong>'Showing all {0}'</strong></code>: determines which string format to use when all options are visible. Set this to <code>false</code> to hide this information. Remember to insert the <code>{0}</code> placeholder.</td>
      </tr>
      <tr>
        <td><code>infoTextFiltered</code></td>
        <td><code><strong>'&lt;span class=&quot;label label-warning&quot;&gt;Filtered&lt;/span&gt; {0} from {1}'</strong></code>: determines which element format to use when some element is filtered. Remember to insert the <code>{0}</code> and <code>{1}</code> placeholders.</td>
      </tr>
      <tr>
        <td><code>infoTextEmpty</code></td>
        <td><code><strong>'Empty list'</strong></code>: determines the string to use when there are no options in the list.</td>
      </tr>
      <tr>
        <td><code>filterOnValues</code></td>
        <td><code><strong>false</strong></code>: set this to <code>true</code> to filter the options according to their values and not their HTML contents.</td>
      </tr>
    </tbody>
  </table>

  <h2>Methods</h2>

  <p>You can modify the behavior and aspect of the dual listbox by calling its methods, all of which accept a <code>value</code> and a <code>refresh</code> option. The <code>value</code> determines the new parameter value, while <code>refresh</code> (optional, defaults to <code>false</code>) tells whether to update the plugin UI or not.</p>

  <p>To call methods on the dual listbox instance, use the following syntax:</p>

  <pre class="prettyprint">
$(selector).bootstrapDualListbox(methodName, parameter);</pre>

  <p><strong>Note</strong>: when making multiple chained calls to the plugin, set <code>refresh</code> to true to the last call only, in order to make a unique UI change; alternatively, you can also call the <code>refresh</code> method as your last one.</p>

  <p>
    Here are the available methods:
  </p>

  <table class="table table-striped table-bordered docs">
    <thead>
      <tr>
        <th>Method</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><code>refresh()</code></td>
        <td>update the plugin element UI.</td>
      </tr>
      <tr>
        <td><code>destroy()</code></td>
        <td>restore the original <code>select</code> element and delete the plugin element.</td>
      </tr>
      <tr>
        <td><code>getContainer()</code></td>
        <td>get the container element.</td>
      </tr>
      <tr>
        <td><code>setBootstrap2Compatible(value, refresh)</code></td>
        <td>change the <code>bootstrap2Compatible</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setFilterTextClear(value, refresh)</code></td>
        <td>change the <code>filterTextClear</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setFilterPlaceHolder(value, refresh)</code></td>
        <td>change the <code>filterPlaceHolder</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setMoveSelectedLabel(value, refresh)</code></td>
        <td>change the <code>moveSelectedLabel</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setMoveAllLabel(value, refresh)</code></td>
        <td>change the <code>moveAllLabel</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setRemoveSelectedLabel(value, refresh)</code></td>
        <td>change the <code>removeSelectedLabel</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setRemoveAllLabel(value, refresh)</code></td>
        <td>change the <code>removeAllLabel</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setMoveOnSelect(value, refresh)</code></td>
        <td>change the <code>moveOnSelect</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setPreserveSelectionOnMove(value, refresh)</code></td>
        <td>change the <code>preserveSelectionOnMove</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setSelectedListLabel(value, refresh)</code></td>
        <td>change the <code>selectedListLabel</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setNonSelectedListLabel(value, refresh)</code></td>
        <td>change the <code>nonSelectedListLabel</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setHelperSelectNamePostfix(value, refresh)</code></td>
        <td>change the <code>helperSelectNamePostfix</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setSelectOrMinimalHeight(value, refresh)</code></td>
        <td>change the <code>selectOrMinimalHeight</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setShowFilterInputs(value, refresh)</code></td>
        <td>change the <code>showFilterInputs</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setNonSelectedFilter(value, refresh)</code></td>
        <td>change the <code>nonSelectedFilter</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setSelectedFilter(value, refresh)</code></td>
        <td>change the <code>selectedFilter</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setInfoText(value, refresh)</code></td>
        <td>change the <code>infoText</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setInfoTextFiltered(value, refresh)</code></td>
        <td>change the <code>infoTextFiltered</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setInfoTextEmpty(value, refresh)</code></td>
        <td>change the <code>infoTextEmpty</code> parameter.</td>
      </tr>
      <tr>
        <td><code>setFilterOnValues(value, refresh)</code></td>
        <td>change the <code>filterOnValues</code> parameter.</td>
      </tr>
    </tbody>
  </table>

</div>
