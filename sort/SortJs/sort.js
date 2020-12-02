let QuickSort = function QuickSort(a, from, to) {
    let third_index = 0;
    while (true) {

      if (to - from <= 10) {
        InsertionSort(a, from, to);
        return;
      }
      if (to - from > 1000) {
        third_index = GetThirdIndex(a, from, to);
      } 
      
      else {
        third_index = from + ((to - from) >> 1);
      }

      let v0 = a[from];
      let v1 = a[to - 1];
      let v2 = a[third_index];
      let c01 = comparefn(v0, v1);
      if (c01 > 0) {

        let tmp = v0;
        v0 = v1;
        v1 = tmp;
      } 
      let c02 = comparefn(v0, v2);
      if (c02 >= 0) {

        let tmp = v0;
        v0 = v2;
        v2 = v1;
        v1 = tmp;
      } else {

        let c12 = comparefn(v1, v2);
        if (c12 > 0) {

          let tmp = v1;
          v1 = v2;
          v2 = tmp;
        }
      }

      a[from] = v0;
      a[to - 1] = v2;
      let pivot = v1;
      let low_end = from + 1;   
      let high_start = to - 1;  
      a[third_index] = a[low_end];
      a[low_end] = pivot;


      partition: for (let i = low_end + 1; i < high_start; i++) {
        let element = a[i];
        let order = comparefn(element, pivot);
        if (order < 0) {
          a[i] = a[low_end];
          a[low_end] = element;
          low_end++;
        } else if (order > 0) {
          do {
            high_start--;
            if (high_start == i) break partition;
            let top_elem = a[high_start];
            order = comparefn(top_elem, pivot);
          } while (order > 0);
          a[i] = a[high_start];
          a[high_start] = element;
          if (order < 0) {
            element = a[i];
            a[i] = a[low_end];
            a[low_end] = element;
            low_end++;
          }
        }
      }
      if (to - high_start < low_end - from) {
        QuickSort(a, high_start, to);
        to = low_end;
      } else {
        QuickSort(a, from, low_end);
        from = high_start;
      }
    }
  };