/**
 *
 * Scripts
 *
 * Initialization of the template base and page scripts.
 *
 *
 */

 class Scripts {
  constructor() {
    this._initSettings();
    this._initVariables();
    this._addListeners();
    this._init();
    this._initPlugins();
  }

  // Showing the template after waiting for a bit so that the css variables are all set
  // Initialization of the common scripts and page specific ones
  _init() {
    setTimeout(() => {
      document.documentElement.setAttribute('data-show', 'true');
      document.body.classList.remove('spinner');
      this._initBase();
      this._initCommon();
      this._initPages();
      this._initApps();
      this._initForms();
    }, 100);
  }

  // Base scripts initialization
  _initBase() {
    // Navigation
    if (typeof Nav !== 'undefined') {
      const nav = new Nav(document.getElementById('nav'));
    }

    // Search implementation
    if (typeof Search !== 'undefined') {
      const search = new Search();
    }

    // AcornIcons initialization
    if (typeof AcornIcons !== 'undefined') {
      new AcornIcons().replace();
    }
  }
// Application pages initialization
_initApps() {
  // calendar.js initialization
  if (typeof Calendar !== 'undefined') {
    let calendar = new Calendar();
  }
  // mailbox.js initialization
  if (typeof Mailbox !== 'undefined') {
    let mailbox = new Mailbox();
  }
  // contacts.js initialization
  if (typeof Contacts !== 'undefined') {
    let contacts = new Contacts();
  }
  // chat.js initialization
  if (typeof Chat !== 'undefined') {
    const chat = new Chat();
  }
  // task.js initialization
  if (typeof Tasks !== 'undefined') {
    const tasks = new Tasks();
  }
}
 // Form and form controls pages initialization
 _initForms() {
  // layouts.js initialization
  if (typeof FormLayouts !== 'undefined') {
    const formLayouts = new FormLayouts();
  }
  // validation.js initialization
  if (typeof FormValidation !== 'undefined') {
    const formValidation = new FormValidation();
  }
  // wizards.js initialization
  if (typeof FormWizards !== 'undefined') {
    const formWizards = new FormWizards();
  }
  // inputmask.js initialization
  if (typeof InputMask !== 'undefined') {
    const inputMask = new InputMask();
  }
  // controls.autocomplete.js initialization
  if (typeof GenericForms !== 'undefined') {
    const genericForms = new GenericForms();
  }
  // controls.autocomplete.js initialization
  if (typeof AutocompleteControls !== 'undefined') {
    const autocompleteControls = new AutocompleteControls();
  }
  // controls.datepicker.js initialization
  if (typeof DatePickerControls !== 'undefined') {
    const datePickerControls = new DatePickerControls();
  }
  // controls.datepicker.js initialization
  if (typeof DropzoneControls !== 'undefined') {
    const dropzoneControls = new DropzoneControls();
  }
  // controls.editor.js initialization
  if (typeof EditorControls !== 'undefined') {
    const editorControls = new EditorControls();
  }
  // controls.spinner.js initialization
  if (typeof SpinnerControls !== 'undefined') {
    const spinnerControls = new SpinnerControls();
  }
  // controls.rating.js initialization
  if (typeof RatingControls !== 'undefined') {
    const ratingControls = new RatingControls();
  }
  // controls.select2.js initialization
  if (typeof Select2Controls !== 'undefined') {
    const select2Controls = new Select2Controls();
  }
  // controls.slider.js initialization
  if (typeof SliderControls !== 'undefined') {
    const sliderControls = new SliderControls();
  }
  // controls.tag.js initialization
  if (typeof TagControls !== 'undefined') {
    const tagControls = new TagControls();
  }
  // controls.timepicker.js initialization
  if (typeof TimePickerControls !== 'undefined') {
    const timePickerControls = new TimePickerControls();
  }
}

  // Common plugins and overrides initialization
  _initCommon() {
    // common.js initialization
    if (typeof Common !== 'undefined') {
      let common = new Common();
    }
  }


  // Pages initialization
  _initPages() {
    // customers.detail.js initialization
    if (typeof CustomersDetail !== 'undefined') {
      const customersDetail = new CustomersDetail();
    }
    // customers.list.js initialization
    if (typeof CustomersList !== 'undefined') {
      const customersList = new CustomersList();
    }
    // dashboard.js initialization
    if (typeof Dashboard !== 'undefined') {
      const dashboard = new Dashboard();
    }
    // discount.js initialization
    if (typeof Discount !== 'undefined') {
      const discount = new Discount();
    }
    // orders.list.js initialization
    if (typeof OrdersList !== 'undefined') {
      const ordersList = new OrdersList();
    }
    // products.detail.js initialization
    if (typeof ProductsDetail !== 'undefined') {
      const productsDetail = new ProductsDetail();
    }
    // products.list.js initialization
    if (typeof ProductsList !== 'undefined') {
      const productsList = new ProductsList();
    }
    // settings.general.js initialization
    if (typeof SettingsGeneral !== 'undefined') {
      const settingsGeneral = new SettingsGeneral();
    }
    // storefront.categories.js initialization
    if (typeof StorefrontCategories !== 'undefined') {
      const storefrontCategories = new StorefrontCategories();
    }
    // storefront.checkout.js initialization
    if (typeof StorefrontCheckout !== 'undefined') {
      const storefrontCheckout = new StorefrontCheckout();
    }
    // storefront.detail.js initialization
    if (typeof StorefrontDetail !== 'undefined') {
      const storefrontDetail = new StorefrontDetail();
    }
    // storefront.filters.js initialization
    if (typeof StorefrontFilters !== 'undefined') {
      const storefrontFilters = new StorefrontFilters();
    }
    // storefront.home.js initialization
    if (typeof StorefrontHome !== 'undefined') {
      const storefrontHome = new StorefrontHome();
    }
  }

  // Settings initialization
  _initSettings() {
    if (typeof Settings !== 'undefined') {
      const settings = new Settings({attributes: {placement: 'vertical', layout: 'boxed', color: 'light-green' }, showSettings: true, storagePrefix: 'acorn-ecommerce-platform-'});
    }
  }

  // Plugin pages initialization
  _initPlugins() {
    // carousels.js initialization
    if (typeof Carousels !== 'undefined') {
      const carousels = new Carousels();
    }
    // charts.js initialization
    if (typeof Charts !== 'undefined') {
      const charts = new Charts();
    }
    // contextmenu.js initialization
    if (typeof ContextMenu !== 'undefined') {
      const contextMenu = new ContextMenu();
    }
    // lightbox.js initialization
    if (typeof Lightbox !== 'undefined') {
      const lightbox = new Lightbox();
    }

    // lists.js initialization
    if (typeof Lists !== 'undefined') {
      const lists = new Lists();
    }
    // notifies.js initialization
    if (typeof Notifies !== 'undefined') {
      const notifies = new Notifies();
    }
    // players.js initialization
    if (typeof Players !== 'undefined') {
      const players = new Players();
    }
    // progressbars.js initialization
    if (typeof ProgressBars !== 'undefined') {
      const progressBars = new ProgressBars();
    }
    // shortcuts.js initialization
    if (typeof Shortcuts !== 'undefined') {
      const shortcuts = new Shortcuts();
    }
    // sortables.js initialization
    if (typeof Sortables !== 'undefined') {
      const sortables = new Sortables();
    }
    // datatable.editablerows.js initialization
    if (typeof EditableRows !== 'undefined') {
      const editableRows = new EditableRows();
    }
    // datatable.editableboxed.js initialization
    if (typeof EditableBoxed !== 'undefined') {
      const editableBoxed = new EditableBoxed();
    }
    // datatable.ajax.js initialization
    if (typeof RowsAjax !== 'undefined') {
      const rowsAjax = new RowsAjax();
    }
    // datatable.serverside.js initialization
    if (typeof RowsServerSide !== 'undefined') {
      const rowsServerSide = new RowsServerSide();
    }
    // datatable.serverside.js initialization
    if (typeof BoxedVariations !== 'undefined') {
      const boxedVariations = new BoxedVariations();
    }
   
  }

  // Variables initialization of Globals.js file which contains valus from css
  _initVariables() {
    if (typeof Variables !== 'undefined') {
      const variables = new Variables();
    }
  }

  // Listeners of menu and layout changes which fires a resize event
  _addListeners() {
    document.documentElement.addEventListener(Globals.menuPlacementChange, (event) => {
      setTimeout(() => {
        window.dispatchEvent(new Event('resize'));
      }, 25);
    });

    document.documentElement.addEventListener(Globals.layoutChange, (event) => {
      setTimeout(() => {
        window.dispatchEvent(new Event('resize'));
      }, 25);
    });

    document.documentElement.addEventListener(Globals.menuBehaviourChange, (event) => {
      setTimeout(() => {
        window.dispatchEvent(new Event('resize'));
      }, 25);
    });
  }
}

// Shows the template after initialization of the settings, nav, variables and common plugins.
(function () {
  window.addEventListener('DOMContentLoaded', () => {
    // Initializing of the Scripts
    if (typeof Scripts !== 'undefined') {
      const scripts = new Scripts();
    }
  });
})();

// Disabling dropzone auto discover before DOMContentLoaded
(function () {
  if (typeof Dropzone !== 'undefined') {
    Dropzone.autoDiscover = false;
  }
})();
