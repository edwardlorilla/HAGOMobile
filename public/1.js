webpackJsonp([1],{

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(57)
/* template */
var __vue_template__ = __webpack_require__(58)
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
Component.options.__file = "resources\\assets\\js\\components\\NavigationMaster.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key.substr(0, 2) !== "__"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] NavigationMaster.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-201b31ea", Component.options)
  } else {
    hotAPI.reload("data-v-201b31ea", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 57:
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

/* harmony default export */ __webpack_exports__["default"] = ({
    name: 'navigationMaster',
    data: function data() {
        return {
            items: [{
                title: 'Item Title',
                label: '4 h',
                desc: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
            }, {
                title: 'Another Item Title',
                label: '6 h',
                desc: 'Ut enim ad minim veniam.'
            }, {
                title: 'Yet Another Item Title',
                label: '1 day ago',
                desc: 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
            }, {
                title: 'And One More Item Title',
                label: '3 days ago',
                desc: 'Minim veniam aute irure dolor in eiusmod tempor incididunt ut labore et dolore eu fugiat nulla pariatur.'
            }]
        };
    }
});

/***/ }),

/***/ 58:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "transition",
    { attrs: { name: "slide" } },
    [
      _c(
        "v-ons-page",
        [
          _c("v-ons-toolbar", [
            _c("div", { staticClass: "center" }, [_vm._v("Simple Navigation")]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "right" },
              [
                _c(
                  "v-ons-toolbar-button",
                  {
                    attrs: { modifier: "quiet" },
                    on: {
                      click: function($event) {
                        _vm.$router.replace({ name: "home" })
                      }
                    }
                  },
                  [_vm._v("\n                    Home\n                ")]
                )
              ],
              1
            )
          ]),
          _vm._v(" "),
          _c(
            "v-ons-list",
            _vm._l(_vm.items, function(item, index) {
              return _c(
                "v-ons-list-item",
                {
                  key: item.title,
                  staticClass: "item",
                  attrs: { modifier: "chevron" },
                  on: {
                    click: function($event) {
                      _vm.$router.push({
                        name: "navigationDetail",
                        params: { detail: item }
                      })
                    }
                  }
                },
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
                            _vm._v(_vm._s(item.title))
                          ]),
                          _vm._v(" "),
                          _c("span", { staticClass: "item-label" }, [
                            _vm._v(_vm._s(item.label))
                          ])
                        ]),
                        _vm._v(" "),
                        _c("p", { staticClass: "item-desc" }, [
                          _vm._v(_vm._s(item.desc))
                        ])
                      ])
                    ],
                    1
                  )
                ],
                1
              )
            })
          ),
          _vm._v(" "),
          _c(
            "p",
            { staticStyle: { "margin-top": "5%", "text-align": "center" } },
            [
              _vm._v("\n            Let's switch to "),
              _c(
                "v-ons-button",
                {
                  attrs: { modifier: "cta" },
                  on: {
                    click: function($event) {
                      _vm.$router.push({ path: "/splitterMain" })
                    }
                  }
                },
                [_vm._v("the Splitter")]
              ),
              _vm._v(" >>\n        ")
            ],
            1
          )
        ],
        1
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
     require("vue-hot-reload-api").rerender("data-v-201b31ea", module.exports)
  }
}

/***/ })

});