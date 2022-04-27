import {el, registerBlock} from './guten-helpers.js';
import {richField} from './rich-field.js';

const {TextControl, CheckboxControl} = wp.components;

const jobEdit = function(props) {
  // Description
  const desc = richField(
      props,
      'desc',
      'job',
      'Job description:'
  );
  // Partner
  const partnerArgs = {
    onChange: (value) => props.setAttributes({partner: value}),
    label: 'Partner organization(s)',
    value: props.attributes.partner,
  };
  const partner = el(
      TextControl,
      partnerArgs
  );
  // Location
  const locArgs = {
    onChange: (value) => props.setAttributes({loc: value}),
    label: 'Location',
    value: props.attributes.loc,
  };
  const loc = el(
      TextControl,
      locArgs
  );
  // Start date
  const startArgs = {
    onChange: (value) => props.setAttributes({start: value}),
    label: 'Start date',
    help: '(e.g. "Summer 2020", "May 31, 2022", etc.)',
    value: props.attributes.start,
  };
  const start = el(
      TextControl,
      startArgs
  );
  // Apply link
  const linkArgs = {
    onChange: (value) => props.setAttributes({link: value}),
    label: 'Application URL',
    value: props.attributes.link,
  };
  const link = el(
      TextControl,
      linkArgs
  );
  // Is active
  const isActive = el(
      CheckboxControl,
      {
        label: 'Accepting applications',
        help: 'Indicate whether this position is currently ' +
        'accepting applications.',
        checked: props.attributes.is_avail,
        onChange: (value) => props.setAttributes({is_avail: value}),
      }
  );
  // Is hidden
  const isHidden = el(
      CheckboxControl,
      {
        label: 'Hidden',
        help: 'Indicate whether this position will be omitted ' +
        'from the list of positions.',
        checked: props.attributes.is_hidden,
        onChange: (value) => props.setAttributes({is_hidden: value}),
      }
  );
  return el(
      'div',
      {className: 'lowtide'},
      [desc, link, start, partner, loc, isActive, isHidden]
  );
};
const jobArgs = {
  title: '(SSLS) Job data',
  category: 'lowtide-blocks',
  icon: 'portfolio',
  attributes: {
    link: {
      type: 'string',
      source: 'meta',
      meta: 'post_job_meta_link',
    },
    desc: {
      type: 'string',
      source: 'meta',
      meta: 'post_job_meta_desc',
    },
    loc: {
      type: 'string',
      source: 'meta',
      meta: 'post_job_meta_location',
    },
    start: {
      type: 'string',
      source: 'meta',
      meta: 'post_job_meta_start_date',
    },
    partner: {
      type: 'string',
      source: 'meta',
      meta: 'post_job_meta_partner',
    },
    is_avail: {
      type: 'boolean',
      source: 'meta',
      meta: 'post_job_meta_is_avail',
    },
    is_hidden: {
      type: 'boolean',
      source: 'meta',
      meta: 'post_job_meta_is_hidden',
    },
  },
  edit: jobEdit,
  save: (props) => null,
};
registerBlock('lowtide/job-data', jobArgs);
