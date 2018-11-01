rivets.adapters[":"] = {
  observe: function(obj, keypath, callback) {
    obj.bind("change:" + keypath, callback);
  },
  unobserve: function(obj, keypath, callback) {
    obj.unbind("change:" + keypath, callback)
  },
  get: function(obj, keypath) {
    return obj[keypath];
  },
  set: function(obj, keypath, value) {
    obj[keypath] = value;
  }
}
