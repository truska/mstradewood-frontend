document.addEventListener('DOMContentLoaded', function () {
  var brandPattern = /\b(?:MS (?:Tradewood|Timber)|MSTradewood)\b/gi;
  var attrNames = ['alt', 'title', 'aria-label', 'placeholder'];

  function normalizeBrandText(value) {
    return String(value).replace(brandPattern, 'MS TRADEWOOD');
  }

  function replaceInTextNodes(root) {
    var walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, {
      acceptNode: function (node) {
        if (!node.nodeValue || !brandPattern.test(node.nodeValue)) {
          brandPattern.lastIndex = 0;
          return NodeFilter.FILTER_REJECT;
        }
        brandPattern.lastIndex = 0;

        var parent = node.parentNode;
        if (!parent) {
          return NodeFilter.FILTER_REJECT;
        }

        var tagName = parent.nodeName;
        if (tagName === 'SCRIPT' || tagName === 'STYLE' || tagName === 'NOSCRIPT' || tagName === 'TEXTAREA') {
          return NodeFilter.FILTER_REJECT;
        }

        return NodeFilter.FILTER_ACCEPT;
      }
    });

    var nodes = [];
    var current;
    while ((current = walker.nextNode())) {
      nodes.push(current);
    }

    nodes.forEach(function (node) {
      var text = node.nodeValue;
      var matches = text.match(brandPattern);
      brandPattern.lastIndex = 0;
      if (!matches) {
        return;
      }

      var fragment = document.createDocumentFragment();
      var lastIndex = 0;

      text.replace(brandPattern, function (match, offset) {
        if (offset > lastIndex) {
          fragment.appendChild(document.createTextNode(text.slice(lastIndex, offset)));
        }

        var span = document.createElement('span');
        span.className = 'brand-ms-tradewood';
        span.textContent = 'MS TRADEWOOD';
        fragment.appendChild(span);

        lastIndex = offset + match.length;
        return match;
      });

      if (lastIndex < text.length) {
        fragment.appendChild(document.createTextNode(text.slice(lastIndex)));
      }

      node.parentNode.replaceChild(fragment, node);
    });
  }

  function replaceInAttributes() {
    attrNames.forEach(function (attrName) {
      document.querySelectorAll('[' + attrName + ']').forEach(function (element) {
        var value = element.getAttribute(attrName);
        if (!value) {
          return;
        }

        var normalized = normalizeBrandText(value);
        if (normalized !== value) {
          element.setAttribute(attrName, normalized);
        }
      });
    });
  }

  replaceInTextNodes(document.body);
  replaceInAttributes();
});
