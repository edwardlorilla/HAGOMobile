<template>
    <div class="autocomplete">
        <label :for="id">{{label}}</label>
      <textarea v-if="textarea" :id="id" :rows="rows" :cols="cols" class="autocomplete-input" :placeholder="placeholder"
                @focusout="focusout" @focus="focus" @keydown.13="chooseItem" @keydown.tab="chooseItem"
                @keydown.40="moveDown" @keydown.38="moveUp" v-model="inputValue"
                type="text"></textarea>
        <input v-else :id="id" class="autocomplete-input" :placeholder="placeholder" @focusout="focusout" @focus="focus"
               @keydown.13="chooseItem" @keydown.tab="chooseItem" @keydown.40="moveDown" @keydown.38="moveUp"
               v-model="inputValue" type="text">


        <ul :class="{
        'autocomplete-list': true,
        [id+'-list']: true
      }" v-if="searchMatch.length > 0">
            <li :class="{active: selectedIndex === index}" v-for="(result, index) in searchMatch"
                @click="selectItem(index), chooseItem()" v-html="highlightWord(result)">

            </li>
        </ul>
    </div>
</template>
<script>
    export default{
        props: ["items", "placeholder", "label", "textarea", "rows", "cols"],
        data() {
            return {
                id: 'input-' + parseInt(Math.random() * 1000),
                inputValue: "",
                searchMatch: [],
                selectedIndex: 0,
                clickedChooseItem: false,
                wordIndex: 0
            };
        },
        mounted() {
            var _self = this;
            document.querySelector('#' + this.id).addEventListener('input', function () {
                var caret = getCaretCoordinates(this, this.selectionEnd);

                if (_self.searchMatch.length > 0) {
                    var element = document.querySelectorAll('.' + _self.id + '-list');

                    if (element[0]) {
                        element[0].style.top = caret.top + 40 + 'px';
                        element[0].style.left = caret.left + 'px';
                    }
                }
            });
        },

        computed: {
            listToSearch() {
                if (typeof this.items !== "undefined" && this.items.length > 0) {
                    return this.items;
                } else {
                    return standardItems;
                }
            },
            currentWord() {
                return this.inputValue.replace(/(\r\n|\n|\r)/gm, ' ').split(' ')[this.wordIndex];
            },
            inputSplitted() {
                return this.inputValue.replace(/(\r\n|\n|\r)/gm, ' ').split(" ");
            }
        },
        watch: {
            inputValue() {
                this.focus();
                console.log(this.inputSplitted);
                this.selectedIndex = 0;
                this.wordIndex = this.inputSplitted.length - 1;
            }
        },
        methods: {
            highlightWord(word) {
                var regex = new RegExp("(" + this.currentWord + ")", "g");
                return word.replace(regex, '<mark>$1</mark>');
            },
            setWord(word) {
                var currentWords = this.inputValue.replace(/(\r\n|\n|\r)/gm, '__br__ ').split(' ');
                currentWords[this.wordIndex] = currentWords[this.wordIndex].replace(this.currentWord, word + ' ');
                this.wordIndex += 1;
                this.inputValue = currentWords.join(' ').replace(/__br__\s/g, '\n');
            },
            moveDown() {
                if (this.selectedIndex < this.searchMatch.length - 1) {
                    this.selectedIndex++;
                }
            },
            moveUp() {
                if (this.selectedIndex !== -1) {
                    this.selectedIndex--;
                }
            },
            selectItem(index) {
                this.selectedIndex = index;
                this.chooseItem();
            },
            chooseItem(e) {
                this.clickedChooseItem = true;

                if (this.selectedIndex !== -1 && this.searchMatch.length > 0) {
                    if (e) {
                        e.preventDefault();
                    }
                    this.setWord(this.searchMatch[this.selectedIndex]);
                    this.selectedIndex = -1;
                }
            },
            focusout(e) {
                var _this = this;

                setTimeout(function () {
                    if (!_this.clickedChooseItem) {
                        _this.searchMatch = [];
                        _this.selectedIndex = -1;
                    }
                    _this.clickedChooseItem = false;
                }, 100);
            },
            focus() {
                var _this2 = this;

                this.searchMatch = [];
                if (this.currentWord !== "") {
                    this.searchMatch = this.listToSearch.filter(function (el) {
                        return el.indexOf(_this2.currentWord) >= 0;
                    });
                }
                if (this.searchMatch.length === 1 && this.currentWord === this.searchMatch[0]) {
                    this.searchMatch = [];
                }
            }
        }
    }
</script>