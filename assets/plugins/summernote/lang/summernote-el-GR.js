(function ($) {
  $.extend($.summernote.lang, {
    'el-GR': {
      font: {
        bold: 'Έντονα',
        italic: 'Πλάγια',
        underline: 'Υπογραμμισμένα',
        clear: 'Καθαρισμός',
        height: 'Ύψος',
        name: 'Γραμματοσειρά',
        strikethrough: 'Διεγραμμένα',
        subscript: 'Δείκτης',
        superscript: 'Εκθέτης',
        size: 'Μέγεθος'
      },
      image: {
        image: 'εικόνα',
        insert: 'Εισαγωγή',
        resizeFull: 'Πλήρες μέγεθος',
        resizeHalf: 'Μισό μέγεθος',
        resizeQuarter: '1/4 μέγεθος',
        floatLeft: 'Μετατόπιση αριστερά',
        floatRight: 'Μετατόπιση δεξιά',
        floatNone: 'Χωρίς μετατόπιση',
        shapeRounded: 'Σχήμα: Στρογγυλεμένο',
        shapeCircle: 'Σχήμα: Κύκλος',
        shapeThumbnail: 'Σχήμα: Thumbnail',
        shapeNone: 'Σχήμα: Κανένα',
        dragImageHere: 'Σύρτε την εικόνα εδώ',
        dropImage: 'Αφήστε την εικόνα',
        selectFromFiles: 'Επιλογή από αρχεία',
        maximumFileSize: 'Μέγιστο μέγεθος αρχείου',
        maximumFileSizeError: 'Το μέγεθος είναι μεγαλύτερο από το μέγιστο επιτρεπτό.',
        url: 'URL',
        remove: 'Αφαίρεση'
      },
      link: {
        link: 'Σύνδεσμος',
        insert: 'Εισαγωγή συνδέσμου',
        unlink: 'Αφαίρεση συνδέσμου',
        edit: 'Επεξεργασία συνδέσμου',
        textToDisplay: 'Κείμενο συνδέσμου',
        url: 'URL',
        openInNewWindow: 'Άνοιγμα σε νέο παράθυρο'
      },
      video: {
        video: 'Βίντεο',
        videoLink: 'Σύνδεσμος Βίντεο',
        insert: 'Εισαγωγή',
        url: 'URL',
        providers: '(YouTube, Vimeo, Vine, Instagram, DailyMotion or Youku)'
      },
      table: {
        table: 'Πίνακας'
      },
      hr: {
        insert: 'Εισαγωγή οριζόντιας γραμμής'
      },
      style: {
        style: 'Στυλ',
        normal: 'Κανονικό',
        blockquote: 'Παράθεση',
        pre: 'Ως έχει',
        h1: 'Κεφαλίδα 1',
        h2: 'συνδέσμου 2',
        h3: 'συνδέσμου 3',
        h4: 'συνδέσμου 4',
        h5: 'συνδέσμου 5',
        h6: 'συνδέσμου 6'
      },
      lists: {
        unordered: 'Αταξινόμητη λίστα',
        ordered: 'Ταξινομημένη λίστα'
      },
      options: {
        help: 'Βοήθεια',
        fullscreen: 'Πλήρης οθόνη',
        codeview: 'Προβολή HTML'
      },
      paragraph: {
        paragraph: 'Παράγραφος',
        outdent: 'Μείωση εσοχής',
        indent: 'Άυξηση εσοχής',
        left: 'Αριστερή στοίχιση',
        center: 'Στοίχιση στο κέντρο',
        right: 'Δεξιά στοίχιση',
        justify: 'Πλήρης στοίχιση'
      },
      color: {
        recent: 'Πρόσφατη επιλογή',
        more: 'Περισσότερα',
        background: 'Υπόβαθρο',
        foreground: 'Μπροστά',
        transparent: 'Διαφανές',
        setTransparent: 'Επιλογή διαφάνειας',
        reset: 'Επαναφορά',
        resetToDefault: 'Επαναφορά στις προκαθορισμένες τιμές'
      },
      shortcut: {
        shortcuts: 'Συντομεύσεις',
        close: 'Κλείσιμο',
        textFormatting: 'Διαμόρφωση κειμένου',
        action: 'Ενέργεια',
        paragraphFormatting: 'Διαμόρφωση παραγράφου',
        documentStyle: 'Στυλ κειμένου',
        extraKeys: 'Επιπλέον συντομεύσεις'
      },
      help: {
        'insertParagraph': 'Εισαγωγή παραγράφου',
        'undo': 'Αναιρεί την προηγούμενη εντολή',
        'redo': 'Επαναλαμβάνει την προηγούμενη εντολή',
        'tab': 'Εσοχή',
        'untab': 'Αναίρεση εσοχής',
        'bold': 'Ορισμός έντονου στυλ',
        'italic': 'Ορισμός πλάγιου στυλ',
        'underline': 'Ορισμός υπογεγραμμένου στυλ',
        'strikethrough': 'Ορισμός διεγραμμένου στυλ',
        'removeFormat': 'Αφαίρεση στυλ',
        'justifyLeft': 'Ορισμός αριστερής στοίχισης',
        'justifyCenter': 'Ορισμός κεντρικής στοίχισης',
        'justifyRight': 'Ορισμός δεξιάς στοίχισης',
        'justifyFull': 'Ορισμός πλήρους στοίχισης',
        'insertUnorderedList': 'Ορισμός μη-ταξινομημένης λίστας',
        'insertOrderedList': 'Ορισμός ταξινομημένης λίστας',
        'outdent': 'Προεξοχή παραγράφου',
        'indent': 'Εσοχή παραγράφου',
        'formatPara': 'Αλλαγή της μορφής του τρέχοντος μπλοκ σε παράγραφο (P tag)',
        'formatH1': 'Αλλαγή της μορφής του τρέχοντος μπλοκ σε H1',
        'formatH2': 'Αλλαγή της μορφής του τρέχοντος μπλοκ σε H2',
        'formatH3': 'Αλλαγή της μορφής του τρέχοντος μπλοκ σε H3',
        'formatH4': 'Αλλαγή της μορφής του τρέχοντος μπλοκ σε H4',
        'formatH5': 'Αλλαγή της μορφής του τρέχοντος μπλοκ σε H5',
        'formatH6': 'Αλλαγή της μορφής του τρέχοντος μπλοκ σε H6',
        'insertHorizontalRule': 'Εισαγωγή οριζόντιας γραμμής',
        'linkDialog.show': 'Εμφάνιση διαλόγου συνδέσμου'
      },
      history: {
        undo: 'Αναίρεση',
        redo: 'Επαναληψη'
      },
      specialChar: {
        specialChar: 'SPECIAL CHARACTERS',
        select: 'Επιλέξτε ειδικούς χαρακτήρες'
      }
    }
  });
})(jQuery);
