import {el} from './guten-helpers.js';

const {RichText} = wp.blockEditor;

export const richField = function(props, meta, postType, label) {
  const attrLabel = postType + '-' + meta;
  const descArgs = {
    onChange: function(value) {
      props.setAttributes(
          {
            [meta]: value,
          }
      );
    },
    value: props.attributes[meta],
    multiline: true,
    className: attrLabel,
    id: attrLabel,
    placeholder: 'Start typing...',
  };
  const desc = el(
      RichText,
      descArgs
  );
  const descLabel = el(
      'label',
      {for: attrLabel},
      label
  );
  const descLabelled = el(
      'div',
      {
        className: 'components-base-control__field',
      },
      [descLabel, desc]
  );
  return el(
      'div',
      {
        className: 'components-base-control event-description-block',
      },
      descLabelled
  );
};
