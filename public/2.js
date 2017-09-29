webpackJsonp([2],{

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(53)
/* template */
var __vue_template__ = __webpack_require__(54)
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\NavigationDetail.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key.substr(0, 2) !== "__"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] NavigationDetail.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2bb8c57a", Component.options)
  } else {
    hotAPI.reload("data-v-2bb8c57a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 53:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    name: 'navigationDetail',
    props: ['detail'],
    methods: {
        goBack: function goBack(event) {
            this.$router.replace({ name: 'navigationMaster' });
        }
    }
});

/***/ }),

/***/ 54:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-ons-page",
    [
      _c("v-ons-toolbar", [
        _c(
          "div",
          { staticClass: "left" },
          [
            _c(
              "v-ons-back-button",
              {
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.goBack($event)
                  }
                }
              },
              [_vm._v("Back")]
            )
          ],
          1
        ),
        _vm._v(" "),
        _c("div", { staticClass: "center" }, [_vm._v("Details")])
      ]),
      _vm._v(" "),
      _c(
        "v-ons-list",
        { staticStyle: { "margin-top": "10px" }, attrs: { modifier: "inset" } },
        [
          _c(
            "v-ons-list-item",
            { staticClass: "item" },
            [
              _c(
                "v-ons-row",
                [
                  _c("v-ons-col", { attrs: { width: "60px" } }, [
                    _c("div", { staticClass: "item-thum" })
                  ]),
                  _vm._v(" "),
                  _c("v-ons-col", [
                    _c("header", [
                      _c("span", { staticClass: "item-title" }, [
                        _vm._v(_vm._s(_vm.detail.title))
                      ]),
                      _vm._v(" "),
                      _c("span", { staticClass: "item-label" }, [
                        _vm._v(_vm._s(_vm.detail.label))
                      ])
                    ]),
                    _vm._v(" "),
                    _c("p", { staticClass: "item-desc" }, [
                      _vm._v(_vm._s(_vm.detail.desc))
                    ])
                  ])
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "v-ons-list-item",
            { attrs: { modifier: "chevron", tappable: "" } },
            [
              _c("v-ons-icon", {
                staticStyle: { color: "#ccc" },
                attrs: { icon: "ion-chatboxes", "fixed-width": "true" }
              }),
              _vm._v("\n            Add a note\n        ")
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-ons-list",
        { staticStyle: { "margin-top": "10px" } },
        _vm._l([1, 2, 3], function(i) {
          return _c("v-ons-list-item", { key: i, staticClass: "item" }, [
            _c("header", [
              _c("span", { staticClass: "item-title" }, [
                _vm._v("Lorem ipsum dolor sit amet")
              ])
            ]),
            _vm._v(" "),
            _c("p", { staticClass: "item-desc" }, [
              _vm._v(
                "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
              )
            ])
          ])
        })
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-2bb8c57a", module.exports)
  }
}

/***/ })

});